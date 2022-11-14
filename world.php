<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';



$country = filter_input(INPUT_GET, 'country',FILTER_SANITIZE_STRING,
FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

$city = filter_input(INPUT_GET, 'context',FILTER_SANITIZE_STRING,
FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%' ");
$all_cities = $conn->query("SELECT cities.name, cities.district, cities.population 
FROM cities 
JOIN countries 
ON cities.country_code = countries.code WHERE countries.name LIKE '%$country%'");

$countryQ= $stmt->fetchAll(PDO::FETCH_ASSOC);
$citiesQ= $all_cities->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if ($city=='city'): ?>
  <table>
      <tr>
          <th> Name</th>  
          <th> District</th>  
          <th> Popululation</th>
      </tr>

      <tbody>
      <?php foreach ($citiesQ as $town): ?>
                <tr>
                    <td> <?= $town['name']; ?></td>  
                    <td> <?= $town['district']; ?></td>  
                    <td> <?= $town['population']; ?></td>  
                </tr>
             <?php endforeach; ?>
            </tbody>
        </table>
  <?php elseif ($city == ''):  ?>
    <table>
        <tr>
          <th> Country Name</th>  
          <th> Continent</th>  
          <th> Indenpendence Year</th>  
          <th> Head of State</th>  
        </tr>
        
        <tbody>
        <?php foreach ($countryQ as $place): ?>
            <tr>
                <td> <?= $place['name']; ?></td>  
                <td> <?= $place['continent']; ?></td>  
                <td> <?= $place['independence_year']; ?></td>  
                <td> <?= $place['head_of_state']; ?></td>  
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
        


<?php endif ?>

