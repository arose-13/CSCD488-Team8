package budgetapp.databaseConnection;

import java.sql.*;
import java.util.Scanner;
import java.util.UUID;

import budgetapp.appUser.UserData;

import java.util.Date;

public class JavaDBConnect {
    private static Connection connection;
    private static final String DB_URL = "jdbc:mysql://localhost:3306/budgetappuser";
    private static final String USERNAME = "sqluser";
    private static final String PASSWORD = "Team8Password";

    public static void main(String[] args) {
        connectToDB();
        fetchAllUsers();
        closeDBConnection();
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

    private static void createUser(int verification, String userName, String password, String email, UserData m1, UserData m2, UserData m3, UserData m4, UserData m5, UserData m6, UserData m7, UserData m8, UserData m9, UserData m10, UserData m11, UserData m12) {
        try {
            UUID id = UUID.randomUUID();
            Date currentDate = new Date();
            String sql = "INSERT INTO `appusertable` VALUES (?,?,?,?,?,?,'USER',?,?,?,?,?,?,?,?,?,?,?,?)";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setObject(1, id);
            pstmt.setString(2, userName);
            pstmt.setString(3, password);
            pstmt.setString(4, email);
            pstmt.setObject(5, currentDate);
            pstmt.setInt(6, verification);
            pstmt.setObject(7, m1);
            pstmt.setObject(8, m2);
            pstmt.setObject(9, m3);
            pstmt.setObject(10, m4);
            pstmt.setObject(11, m5);
            pstmt.setObject(12, m6);
            pstmt.setObject(13, m7);
            pstmt.setObject(14, m8);
            pstmt.setObject(15, m9);
            pstmt.setObject(16, m10);
            pstmt.setObject(17, m11);
            pstmt.setObject(18, m12);
            pstmt.executeUpdate(sql);
        } catch (SQLException e) {
            System.out.println("Error creating a user: " + e.getMessage());
        }
    }

    private static void changePassword(String userName, String newPass) { // could eventually send out verification emails prior to changing a field 
        try{ 
            String sql = "UPDATE `appusertable` SET password = + ? + WHERE userName = ?";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setString(1, newPass);
            pstmt.setString(2, userName);
            pstmt.executeUpdate(sql);
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
        }
    }

    private static void changeUserName(String userName, String newUName) {
        try{ 
            String sql = "UPDATE `appusertable` SET userName = + ? + WHERE userName = ?";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setString(1, newUName);
            pstmt.setString(2, userName);
            pstmt.executeUpdate();
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
        }
    }

    private static void changeEmail(String userName, String newEmail) {
        try{ 
            String sql = "UPDATE `appusertable` SET email = + ? + WHERE userName = ?";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setString(1, newEmail);
            pstmt.setString(2, userName);
            pstmt.executeUpdate(sql);
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
        }
    }

    private static void deleteUser(String userName) {
        try{
            String sql = "DELETE FROM `appusertable` WHERE userName = ?";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setString(1, userName);
            pstmt.executeUpdate(sql);
        } catch (SQLException e) {
            System.out.println("Error deleting a user: " + e.getMessage());
        }
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

