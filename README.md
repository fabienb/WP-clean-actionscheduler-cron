# WordPress ActionScheduler Cleanup Script

## Overview
This PHP script is designed to clean up specific tables in a WordPress database using MySQL queries. It targets the actionscheduler_actions table to delete entries with statuses of 'canceled', 'failed', and 'complete'. 
Additionally, it can optionally truncate the actionscheduler_logs table to clear all logs.
The need for this script has arisen after WordPress' failure to clean up the database automatically brought my database to the ridiculous size of 3Gb. I wrote about it [here](https://fabienb.blog/almost-blew-up-wordpress-blog-with-wrong-setting/) 

## Features
- Dynamic Table Prefix: Automatically retrieves the table prefix from wp-config.php, making it compatible with any custom prefixes.
- Secure Database Connection: Utilizes PDO for secure database connections with error handling.
- Cron Job Integration: Can be scheduled to run at regular intervals using a server cron job.

## Requirements
- PHP 5.3+: The script uses features available in PHP 5.3 and above.
- WordPress Installation: Access to the wp-config.php file is required for database credentials and table prefix.
- Access to hosting management panel: This guide assumes you are using Hostinger for hosting, but the information should work with other hosting platforms in a similar way.

## Setup Instructions
### Step 1: Create the PHP Script
- Create a new file named cleanup_scheduler.php.
- Copy and paste the code from the clean_actionscheduler.php file included in this repo or upload it
- Modify the path in ```include('path/to/wp-config.php');``` to point to your actual wp-config.php file.

### Step 2: Upload the Script
- Upload the cleanup_scheduler.php script to a directory on your server where it can be accessed via cron.
  - It is recommended to place this script in a hidden directory or outside of the public HTML folder for security reasons.

### Step 3: Set Up Cron Job on Hostinger
- Log into your Hostinger Control Panel.
- Navigate to the Cron Jobs section.
- Click on "Create New Task".
- In the "Command" field, enter: ```/usr/bin/php -q /home/your_username/path/to/cleanup_scheduler.php```
- Replace ```/usr/bin/php``` with your actual PHP path if it's different. You can find this in your Hostinger Control Panel under PHP Configuration. Replace ```your_username``` and ```path/to/cleanup_scheduler.php``` with your cPanel username and the path to your script, respectively.
- Set the schedule for how often you want the cron job to run (e.g., daily, weekly).
- Click "Create".

### Step 4: Test
- Manually trigger the PHP script to ensure it works as expected. You can do this by running the command manually via SSH or by accessing the script URL if it is publicly accessible.

## Security Considerations
- File Permissions: Set the file permissions to 640 for security. ```chmod 640 /path/to/cleanup_scheduler.php```
- Hidden Directory: Place the script in a hidden directory or outside of the public HTML folder. (i.e .scripts)
- Limit Access: If you must keep the script in a publicly accessible directory, consider adding additional security measures such as IP whitelisting or using a secure URL with authentication.

## Troubleshooting
- *Database Connection Issues:* Ensure that the database credentials in wp-config.php are correct and that the script has the necessary permissions to access the database.
- *Cron Job Not Running:* Check the cron job settings in your Hostinger Control Panel and ensure the command is correct. You can also check the server logs for any errors.
