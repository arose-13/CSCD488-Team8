package budgetapp.databaseConnection;

import java.sql.*;
import java.util.Scanner;
import java.util.UUID;
import java.util.Date;

public class JavaDBConnect {
    private static Connection connection;
    private static final String DB_URL = "jdbc:mysql://localhost:3306/budgetappuser";
    private static final String USERNAME = "sqluser";
    private static final String PASSWORD = "Team8Password";
    private static Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        connectToDB();
        fetchAllUsers();
        closeDBConnection();
        scanner.close();
    }

    private static void connectToDB() {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            connection = DriverManager.getConnection(DB_URL, USERNAME, PASSWORD);
        } catch (SQLException | ClassNotFoundException e) {
            System.out.println("Error connecting to DB: " + e.getMessage());
        }
    }

    private static void fetchAllUsers() {
        try {
            Statement statement = connection.createStatement();
            ResultSet resultSet = statement.executeQuery("select * from `appusertable`");

            while (resultSet.next()) { //This needs to be changed to be useful to the front end
                System.out.println(resultSet.getInt(1)+" | "+resultSet.getString(2)+" | "+resultSet.getString(3)+" | "+resultSet.getString(4));
            }
        } catch (SQLException e) {
            System.out.println("Error fetching all users: " + e.getMessage());
        }
    }

    private static void createUser(int verification) { //just an idea to check for verification here
        try {
            Statement statement = connection.createStatement();
            Scanner scanner = new Scanner(System.in);

            System.out.println("Enter your username: ");
            String username = scanner.nextLine();
            System.out.println("Enter your password: ");
            String password = scanner.nextLine();
            System.out.println("Enter your email: ");
            String email = scanner.nextLine();
            scanner.close();

            UUID id = UUID.randomUUID();
            Date currentDate = new Date();

            statement.executeUpdate("INSERT INTO `appusertable` VALUES ('"+id+"','"+username+"','"+password+"','"+email+"','"+currentDate+"',"+verification+",'USER',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)");

        } catch (SQLException e) {
            System.out.println("Error creating a user: " + e.getMessage());
        }
    }

    private static void changePassword() { // could eventually send out verification emails prior to changing a field 
        try{ 
            Statement statement = connection.createStatement();
            String user = identifyUser();
            System.out.println("Enter your new password: ");
            String newPass = scanner.nextLine();
            statement.executeUpdate("UPDATE `appusertable` SET password = '"+newPass+"' WHERE userName = '"+user+"'");
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
        }
    }

    private static void changeUserName() {
        try{ 
            Statement statement = connection.createStatement();
            String user = identifyUser();
            System.out.println("Enter your new username: ");
            String newUName = scanner.nextLine();
            statement.executeUpdate("UPDATE `appusertable` SET password = '"+newUName+"' WHERE userName = '"+user+"'");
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
        }
    }

    private static void changeEmail() {
        try{ 
            Statement statement = connection.createStatement();
            String user = identifyUser();
            System.out.println("Enter your new username: ");
            String newEmail = scanner.nextLine();
            statement.executeUpdate("UPDATE `appusertable` SET password = '"+newEmail+"' WHERE userName = '"+user+"'");
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
        }
    }

    private static void deleteUser() {
        try{
            Statement statement = connection.createStatement();
            String user = identifyUser();
            statement.executeUpdate("DELETE FROM `appusertable` WHERE userName = '"+user+"'");
        } catch (SQLException e) {
            System.out.println("Error deleting a user: " + e.getMessage());
        }
    }

    private static String identifyUser() { // duplicate code made into a method
        System.out.println("Enter your username: ");
        String user = scanner.nextLine();
        return user;
    }

    private static void closeDBConnection() {
        try {
            connection.close();
        } catch (SQLException e) {
            System.out.println("Error closing DB connection: " + e.getMessage());
        }
    }
}


    // //Sanity Check with Java -> mysql db connection
    // public static void main(String[] args) {
    //     String dbURL = "jdbc:mysql://localhost:3306/budgetappuser";
    //     String username = "sqluser";
    //     String password = "Team8Password";
    //     try {
    //         Class.forName("com.mysql.cj.jdbc.Driver");
    //         Connection connection = DriverManager.getConnection(dbURL, username, password);
    //         Statement statement = connection.createStatement();
    //         ResultSet resultSet = statement.executeQuery("select * from `appusertable`");

    //         while (resultSet.next()) {
    //             System.out.println(resultSet.getInt(1)+" | "+resultSet.getString(2)+" | "+resultSet.getString(3)+" | "+resultSet.getString(4));
    //         }

    //         connection.close();

    //         // Output expected
    //         // 1 | testUser | notHashedPW | testEmail@email.com
    //         // 2 | testUser2 | notHashedPW2 | testEmail@email.com2

    //     } catch (Exception e) {
    //         System.out.println(e);
    //     }
    // }

