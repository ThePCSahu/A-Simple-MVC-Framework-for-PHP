<?php
namespace Core;
/**
 * 
 * Error and Exception handler
 * PHP version 5.6
 */
class Error
{
    /**
     * Error handler. Convert all errors to exceptions by throwing an ErrorException.
     * @param int $level Error level
     * @param string $file Filename the error was raised in
     * @param string $message Error message
     * @param int $line Line number in the file
     * @return void
     */
    public static function errorHandler($level,$message,$file,$line)
    {
        if (error_reporting() !== 0)
        {
            throw new \ErrorException($message,0,$level,$file,$line);
        }
    }
    /**
     * Exception Handler
     * @param Exception $exception The exception
     * @return void
     */
    public static function exceptionHandler($exception)
    {
        if (\App\Config::SHOW_ERRORS) {
            echo "<h1>Fatal error</h1>";
            echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
            echo "<p>Message: '" . $exception->getMessage() . "'</p>";
            echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        } else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

            error_log($message);
            echo "<h1>An error occurred</h1>";
        }
    }

}