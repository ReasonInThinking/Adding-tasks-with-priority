# Simple Task Manager for a local server (PHP + MySQL)

A lightweight web application to manage your daily missions. It allows you to add tasks with different priority levels and automatically sorts them by importance and date.
<img width="1428" height="715" alt="tasks" src="https://github.com/user-attachments/assets/b2157c06-b946-4d73-9eec-e09872b0e0f4" />

## 🚀 Features
- **Add Tasks**: Quickly add missions using a simple form.
- **Priority System**: Choose between **High**, **Medium**, and **Low** priorities.
- **Smart Sorting**: Tasks are automatically ordered by:
    1.  Priority Level (High > Medium > Low).
    2.  Creation Date (Newest first).
- **Delete Functionality**: Remove tasks directly from the dashboard.
- **Responsive Design**: Styled with CSS and Media Queries for different screen sizes.

## 📋 Database Structure
To run this project, create a database named `tasks` and run the following SQL command:

```sql
CREATE TABLE `targets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mission` varchar(255) NOT NULL,
  `priority` enum('High','Medium','Low') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
