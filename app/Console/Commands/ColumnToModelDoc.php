<?php

namespace App\Console\Commands;

use App\Models\BaseModel;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Support\Str;
use PDOException;
use ReflectionClass;
use Throwable;

class ColumnToModelDoc extends Command
{
    use ConfirmableTrait;

    protected $signature = 'model:doc';
    protected $description = 'Generate model doc from database column.';

    public function handle(): int
    {
        $files = array_filter(glob(app_path('Models/*.php')), function ($file) {
            return !str_contains($file, 'BaseModel.php');
        });
        foreach ($files as $file) {
            $model = Str::of($file)
                ->replace('.php', '')
                ->replaceFirst(base_path(), '')
                ->replace('/', '\\')
                ->replaceFirst('app', 'App')
                ->value();
            try {
                $reflectionClass = new ReflectionClass($model);
                /** @var BaseModel $classObject */
                $classObject = $reflectionClass->newInstance();
            } catch (Throwable) {
                $this->error(sprintf("% 32s", $model));
                continue;
            }
            $columns = $this->getColumns($classObject);
            $doc = $this->generateDoc($columns);
            $this->replaceDoc($reflectionClass, $classObject, $doc);
        }
        return self::SUCCESS;
    }

    private function getColumns(BaseModel $classObject): array
    {
        try {
            return $classObject->getConnection()->getSchemaBuilder()->getColumns($classObject->getTable());
        } catch (PDOException $e) {
            $this->error($e->getMessage());
            return [];
        }
    }

    private function generateDoc(array $columns): string
    {
        $str = '/**' . PHP_EOL;
        foreach ($columns as $column) {
            $type = $column['type_name'];
            $this->resolveType($type);
            $name = $column['name'];
            $comment = $column['comment'] ?? $column['name'];
            $nullable = $column['nullable'] ? '?' : '';
            $str .= " * @property $nullable$type \$$name $comment\n";
        }
        $str .= ' */';
        return $str;
    }

    private function resolveType(string &$type): void
    {
        $type = match ($type) {
            'bigint', 'int', 'smallint', 'timestamp', 'tinyint' => 'int',
            'decimal', 'double', 'float' => 'float',
            default => 'string',
        };
    }

    private function replaceDoc(ReflectionClass $reflectionClass, BaseModel $classObject, string $doc): void
    {
        if ($doc == "/**\n */") {
            return;
        }
        $content = file_get_contents($reflectionClass->getFileName());
        $comment = $reflectionClass->getDocComment();
        if ($comment) {
            if ($comment == $doc) {
                $this->info(sprintf("% 32s: %16s %-32s", $reflectionClass->getShortName(), $classObject->getConnection()->getDatabaseName(), $classObject->getTable()));
            } else {
                $content = str_replace($comment, $doc, $content);
                $this->warn(sprintf("% 32s: %16s %-32s", $reflectionClass->getShortName(), $classObject->getConnection()->getDatabaseName(), $classObject->getTable()));
                file_put_contents($reflectionClass->getFileName(), $content);
            }
        } else {
            $className = $reflectionClass->getShortName();
            $extends = $reflectionClass->getParentClass()->getShortName();
            $line = "\nclass $className extends $extends\n";
            $content = str_replace($line, "\n$doc$line", $content);
            $this->warn(sprintf("% 32s: %16s %-32s", $reflectionClass->getShortName(), $classObject->getConnection()->getDatabaseName(), $classObject->getTable()));
            file_put_contents($reflectionClass->getFileName(), $content);
        }
    }
}
