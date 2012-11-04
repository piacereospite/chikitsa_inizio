<html>
	<head>
		<title>Chikitsa - Patient Management System</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
<body>
<?php
class Database
      {
        var $db_connection = null;        // Database connection string
        var $db_server = null;            // Database server
        var $db_database = null;          // The database being connected to
        var $db_username = null;          // The database username
        var $db_password = null;          // The database password
        /** NewConnection Method
         * This method establishes a new connection to the database. */
        public function Connection($server, $username, $password)
        {
            
            // Assign variables
            global $db_connection, $db_server, $db_username, $db_password;
            $db_server = $server;
            $db_username = $username;
            $db_password = $password;

            // Attempt connection
            try
            {
                
                // Create connection to MYSQL database
                // Fourth true parameter will allow for multiple connections to be made
                $db_connection = mysql_connect ($server, $username, $password, true);
                if (!$db_connection)
                {
                    throw new Exception('MySQL Connection Database Error: ' . mysql_error());
                }
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }

        /** Open Method
        * This method opens the database connection (only call if closed!) */
        public function Open()
        {
            global $db_connection, $db_server, $db_database, $db_username, $db_password;
            if (!$CONNECTED)
            {
                try
                {
                    $db_connection = mysql_connect ($db_server, $db_username, $db_password);
                    mysql_select_db ($db_database);
                    if (!$db_connection)
                    {
                        throw new Exception('MySQL Connection Database Error: ' . mysql_error());
                    }
                }
                catch (Exception $e)
                {
                    echo $e->GetMessage();
                }
            }
            else
            {
                return "Error: No connection has been established to the database. Cannot open connection.";
            }
        }

        /** Close Method
         * This method closes the connection to the MySQL Database */
         public function Close()
         {
            global $db_connection;
            if ($db_connection)
            {
                mysql_close($db_connection);
                
            }
            else
            {
                return "Error: No connection has been established to the database. Cannot close connection.";
            }
         }
         public function get_Connection()
         {
             global $db_connection;
             return $db_connection;
         }
         /** Create Database Method
         * This method creates database */
         public function CreateDatabase($database)
         {
            global $db_connection;
            if ($db_connection)
            {
                if (!mysql_query("CREATE DATABASE $database",$db_connection))
                {
                    return "Error: Cannot create database." . mysql_error();
                }
            }
            else
            {
                return "Error: No connection has been established to the database. Cannot create database.";
            }       
         }

      }

function is_installed(){
    $config_file = "application/config/config.php";
    $line_array = file($config_file);
    
    for ($i=0;$i < count($line_array); $i++)
    {
        if (strstr($line_array[$i], "['install']"))
        {
            if (strstr($line_array[$i],'$config[\'install\'] = 0;'))
            {
                // Application is not installed
                return FALSE;
            }
            elseif (strstr($line_array[$i],'$config[\'install\'] = 1;'))
            {
                // Application is installed
                return TRUE;
            }
        }
    }
      }
?>
<?php 
if (!isset($_GET["step"])) {
    /** Step 1*/
    // Check if application is installled or not      
    if (is_installed())
    {
        echo "Application is already installed. Please delete the install.php file";
    }
    else
    {
        /** Ask for Database Credentials */
		echo "<h1>Chikitsa - Installation</h1>";
		echo "<div class=\"form_style\">";
        echo "<form method='post' action='install.php?step=2' >";
        echo "<div>";
        echo "<label for='server'>Database Host<span class=\"small\">Most cases this is localhost</span></label>";
        echo "<input type='text' name='server'>";
        echo "</div>";
        echo "<div>";
        echo "<label for='dbname'>Database Name<span class=\"small\">Database for Chikitsa Tables</span></label>";
        echo "<input type='text' name='dbname'><input type='checkbox' name='createdb' value='createdb'>Create database<br/>";
        echo "</div>";
        echo "<div>";
        echo "<label for='username'>User Name</label>";
        echo "<input type='text' name='username'><br/>";
        echo "</div>";
        echo "<div>";
        echo "<label for='password'>Password</label>";
        echo "<input type='text' name='password'><br/>";
        echo "</div>";
        echo "<div>";
        echo "<button type=\"submit\" name=\"submit\" class=\"submit\" /></button>";
        echo "</div>";
        echo "</form></div>";
    }
    
}
elseif($_GET["step"] == 2)
{
    // Step 2
    // Connect to Server 
    $conn = new Database;
    echo $conn->Connection($_POST["server"],$_POST["username"],$_POST["password"]);
    $con = $conn->get_Connection();
    // Create Database
    echo $conn->CreateDatabase($_POST["dbname"]);
    // Create Tables 
    mysql_select_db($_POST["dbname"], $con);

    $sql = "CREATE TABLE IF NOT EXISTS address (
            address_id int(11) NOT NULL AUTO_INCREMENT,
            contact_id int(11) NOT NULL,
            type varchar(50) NOT NULL,
            address_line_1 varchar(150) NOT NULL,
            address_line_2 varchar(150) NOT NULL,
            city varchar(50) NOT NULL,
            state varchar(50) NOT NULL,
            postal_code varchar(50) NOT NULL,
            country varchar(50) NOT NULL,
            PRIMARY KEY (address_id)
            );";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating table address : " . mysql_error();
    }

    $sql = "CREATE TABLE IF NOT EXISTS appointments (
            appointment_id int(11) NOT NULL AUTO_INCREMENT,
            appointment_date date NOT NULL,
            start_time time NOT NULL,
            end_time time NOT NULL,
            title varchar(150) NOT NULL,
            patient_id int(11) NOT NULL,
            PRIMARY KEY (appointment_id)
            );";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating table appointments : " . mysql_error();
    }
    $sql = "CREATE TABLE IF NOT EXISTS contacts (
            contact_id int(11) NOT NULL AUTO_INCREMENT,
            first_name varchar(50) DEFAULT NULL,
            middle_name varchar(50) DEFAULT NULL,
            last_name varchar(50) NOT NULL,
            phone_number varchar(15) NOT NULL,
            PRIMARY KEY (`contact_id`)
            );";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating table contacts : " . mysql_error();
    }
    $sql = "CREATE TABLE IF NOT EXISTS contact_details (
            contact_detail_id int(11) NOT NULL AUTO_INCREMENT,
            contact_id int(11) NOT NULL,
            type varchar(50) NOT NULL,
            detail varchar(150) NOT NULL,
            PRIMARY KEY (contact_detail_id)
            );";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating table contact_details : " . mysql_error();
    }
    $sql = "CREATE TABLE IF NOT EXISTS patient (
            patient_id int(11) NOT NULL AUTO_INCREMENT,
            contact_id int(11) NOT NULL,
            patient_since date NOT NULL,
            PRIMARY KEY (patient_id)
            );";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating table patient : " . mysql_error();
    }
    $sql = "CREATE TABLE IF NOT EXISTS settings (
            settings_id int(11) NOT NULL,
            start_time varchar(5) NOT NULL,
            end_time varchar(5) NOT NULL
            );";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating table settings : " . mysql_error();
    }
    $sql = "INSERT INTO settings (settings_id, start_time, end_time) VALUES (1, '9:00a', '7:00p');";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating table visit : " . mysql_error();
    }    
    $sql = "CREATE TABLE IF NOT EXISTS visit (
            visit_id int(11) NOT NULL AUTO_INCREMENT,
            patient_id int(11) NOT NULL,
            notes text NOT NULL,
            type varchar(50) NOT NULL,
            visit_date varchar(60) NOT NULL,
            PRIMARY KEY (`visit_id`)
            );";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating table visit : " . mysql_error();
    }    
    // Create Views
    $sql = "Create View view_contact_email as
            Select contact_id,detail email
            from contact_details
            where type = 'email';";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating view view_contact_email : " . mysql_error();
    }
    $sql = "Create or replace View view_contacts
            as
            Select  contacts.contact_id, 
                    first_name,
                    middle_name,
                    last_name,
                    phone_number,
                    address.address_id,
                    address.type address_type,
                    address_line_1,
                    address_line_2,
                    city,
                    state,
                    country,
                    postal_code
               from contacts, 
                    address
              where contacts.contact_id = address.contact_id;";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating view view_contacts : " . mysql_error();
    }
    $sql = "create or replace view view_email as 
            select contact_id,
                   group_concat(detail) as emails
              from contact_details 
             where type = 'email'
             group by contact_id;";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating view view_email : " . mysql_error();
    }
    $sql = "create or replace view view_patient as 
            Select patient.patient_id,
                   patient.patient_since,
                   contacts.contact_id,
                   contacts.first_name,
                   contacts.middle_name,
                   contacts.last_name,
                   contacts.phone_number,
                   view_email.emails	
              from patient 
                    LEFT JOIN contacts ON patient.contact_id = contacts.contact_id
                    LEFT JOIN view_email ON view_email.contact_id = contacts.contact_id;";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating view view_patient : " . mysql_error();
    }
    $sql = "create or replace view view_address as
            select address_id,
                   contact_id,
                   type address_type,
	           concat(address_line_1,',',address_line_2,',',city,',',state,',',country,',',postal_code) as address
              from address;";
    if (!mysql_query($sql,$con))
    {
        echo "Error creating view view_address : " . mysql_error();
    }
    // Close Connection
    $conn->Close();
    
    // Edit config/database.php file 
    $database_file = "application/config/database.php";
    $line_array = file($database_file);
    
    for ($i=0;$i < count($line_array); $i++)
    {
        
        if (strstr($line_array[$i], "['default']['hostname']"))
        {
            $line_array[$i] = '$db[\'default\'][\'hostname\'] = \'' . $_POST["server"] . '\';' . "\n";
        }
        if (strstr($line_array[$i], "['default']['username']"))
        {
            $line_array[$i] = '$db[\'default\'][\'username\'] = \'' . $_POST["username"] . '\';'. "\n";
        }
        if (strstr($line_array[$i], "['default']['password']"))
        {
            $line_array[$i] = '$db[\'default\'][\'password\'] = \'' . $_POST["password"] . '\';'. "\n";
        }
        if (strstr($line_array[$i], "['default']['database']"))
        {
            $line_array[$i] = '$db[\'default\'][\'database\'] = \'' . $_POST["dbname"] . '\';'. "\n";
        }
    }
    file_put_contents($database_file,$line_array);
    
    //Store that application is installed
    $config_file = "application/config/config.php";
    $line_array = file($config_file);
    
    for ($i=0;$i < count($line_array); $i++)
    {
        if (strstr($line_array[$i], "['install']"))
        {
            $line_array[$i] = '$config[\'install\'] = 1;' . "\n";
        }
    }
    file_put_contents($config_file,$line_array);
}

?>
</body>
</html>