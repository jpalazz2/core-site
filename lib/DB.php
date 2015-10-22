<?hh

class DB {
  private static ?object $mysqli = null;

  public static function initialize() {
		$json = json_decode(file_get_contents('credentials.txt'), true);
    self::$mysqli = mysqli_connect(
      "localhost", 
      $json['user'], 
      $json['password'], 
      "CoREtex",
    );
  }

  public static function query(string $queryString) {
    $query = mysqli_query(self::$mysqli, $queryString);
    $results = array();
    while ($row = $query->fetch_assoc()) {
      $results[] = $row;
    }
    $query->free();
    return $results;
  }

  public static function deinitialize() {
    self::$mysqli?->close();
  }

}
