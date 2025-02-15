# WP-clean-actionscheduler-cron
This PHP script is designed to clean up specific tables in a WordPress database using MySQL queries. It targets the actionscheduler_actions table to delete entries with statuses of 'canceled', 'failed', and 'complete'. Additionally, it can optionally truncate the actionscheduler_logs table to clear all logs.
