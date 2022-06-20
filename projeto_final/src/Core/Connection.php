<?php

namespace App\Core;

use \PDO;
use \PDOException;

abstract class Connection
{
  /** @var PDO */
  private static $instance;

  /** @var PDOException */
  private static $error;

  private const OPTIONS = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_CASE => PDO::CASE_NATURAL
  ];

  /**
   * @return PDO
   */
  public static function getInstance(): PDO
  {
    if (empty(self::$instance)) {
      try {
        self::$instance = new PDO(
          "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";" . DB_PORT,
          DB_USER,
          DB_PASS,
          self::OPTIONS
        );
      } catch (PDOException $e) {
        echo json_encode([
          "error" => $e->getMessage()
        ]);

        die();
      }
    }

    return self::$instance;
  }

  /**
   * @return PDOException|null
   */
  public static function getError(): ?PDOException
  {
    return self::$error;
  }
}
