<p align="center">
<img src="/arts/logo.png" width="600">
</p>

# php-variable-lifetime-analyzer

The lifetime of a variable represents the time a variable exists in a script. It is calculated from the first line to the last line using a given variable.

Favoring variables with a short lifetime can improve code readability and help prevent potential errors. A variable with a long lifetime will likely span from one end of your script to the other, making it difficult to understand. This tool helps monitor the lifetime of your variables and ensures they are placed as close to their usage as possible.

## Phar
This tool is distributed as a [PHP Archive (PHAR)](https://www.php.net/phar):

```
wget https://github.com/DeGraciaMathieu/php-variable-lifetime-analyzer/raw/master/builds/php-variable-lifetime-analyzer
```

```
php variable-lifetime-analyzer --version
```

## Usage

```
php variable-lifetime-analyzer analyze {path}
```

## Example 

```
php variable-lifetime-analyzer analyze app

 ❀ PHP Var Lifetime Analyzer ❀

 117 files found.

 392 variables found.

 ┌───────────────────────────┬──────────────────────────────────────┬───────────────────────┐
 │ Average variable lifetime │ Average variable lifetime per method │ Max variable lifetime │
 ├───────────────────────────┼──────────────────────────────────────┼───────────────────────┤
 │ 2.18                      │ 1.61                                 │ 22.00                 │
 └───────────────────────────┴──────────────────────────────────────┴───────────────────────┘
```

Understanding analysis :

- **Average variable lifetime** : This represents the average lifetime of variables across the entire project. It includes all variables from all methods and can be influenced by variables with very long lifetimes.

- **Average variable lifetime per method** : This is the average of the lifetimes of variables within each method, averaged across all methods. It gives an indication of the average variable lifetime at the method level and is less influenced by extreme values.

- **Max variable lifetime** : The maximum lifetime observed for any variable in the project. This value indicates the longest duration any single variable is in scope during the project's execution.

## Options

| Options               | Description |
|-----------------------|-------------|
| --json=               | Output the analysis results in JSON format |

> [!TIP]  
> Other analysis [tools](https://github.com/DeGraciaMathieu) are available.
