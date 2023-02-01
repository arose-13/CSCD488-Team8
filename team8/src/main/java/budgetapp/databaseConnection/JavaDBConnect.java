package budgetapp.databaseConnection;

import java.sql.*;

import budgetapp.appUser.AppUser;
import budgetapp.appUser.UserData;

import java.util.Date;

public class JavaDBConnect {
    private static Connection connection;
    private static final String DB_URL = "jdbc:mysql://localhost:3306/budgetappuser";
    private static final String USERNAME = "sqluser";
    private static final String PASSWORD = "Team8Password";

    public JavaDBConnect() {
        connectToDB();
    }
    //sanity check
    // public static void main(String[] args) {
    //     JavaDBConnect myConnection = new JavaDBConnect();
    // }

    private static void connectToDB() {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            connection = DriverManager.getConnection(DB_URL, USERNAME, PASSWORD);
        } catch (SQLException | ClassNotFoundException e) {
            System.out.println("Error connecting to DB: " + e.getMessage());
        }
    }

    public void fetchAllUsers() {
        try {
            Statement statement = connection.createStatement();
            ResultSet resultSet = statement.executeQuery("select * from `appusertable`");
            while (resultSet.next()) { //This needs to be changed to be useful to the front end
                System.out.println(resultSet.getInt(1)+" | "+resultSet.getString(2)+" | "+resultSet.getString(3)+" | "+resultSet.getString(4));
            }
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error fetching all users: " + e.getMessage());
            closeDBConnection();
        }
    }

    public UserData[] updateUserData(AppUser user) {
        updateUserData(user.getuName(), user.getEmail(), user.getuDate(), user.getData());
        return user.getData();
    }

    private void updateUserData(String userName, String email, Date createDate, UserData[] data) {
        try {
            String sql = "UPDATE `appusertable` SET (m01, m02, m03, m04, m05, m06, m07, m08, m09, m10, m11, m12) VALUES (?,?,?,?,?,?,?,?,?,?,?,?) WHERE (userName = ? AND email = ? AND userCreationDate = ?);";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setObject(1, data[0]);
            pstmt.setObject(2, data[1]);
            pstmt.setObject(3, data[2]);
            pstmt.setObject(4, data[3]);
            pstmt.setObject(5, data[4]);
            pstmt.setObject(6, data[5]);
            pstmt.setObject(7, data[6]);
            pstmt.setObject(8, data[7]);
            pstmt.setObject(9, data[8]);
            pstmt.setObject(10, data[9]);
            pstmt.setObject(11, data[10]);
            pstmt.setObject(12, data[11]);
            pstmt.setString(13, userName);
            pstmt.setString(14, email);
            pstmt.setObject(15, createDate);
            pstmt.executeUpdate(sql);
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error creating a user: " + e.getMessage());
            closeDBConnection();
        }
    }

    public AppUser createNewUser(AppUser newUser) {
        createNewUser(newUser.getuName(), newUser.getPassword(), newUser.getEmail(), newUser.getuDate());
        return newUser;
    }

    private void createNewUser(String userName, String password, String email, Date createDate) {
        try {
            String sql = "INSERT INTO `appusertable`(userName, password, email, userCreationDate) VALUES (?,?,?,?);";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setString(1, userName);
            pstmt.setString(2, password);
            pstmt.setString(3, email);
            pstmt.setObject(4, createDate);
            pstmt.executeUpdate(sql);
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error creating a user: " + e.getMessage());
            closeDBConnection();
        }
    }

    public void changePassword(String userName, String newPass) { // could eventually send out verification emails prior to changing a field 
        try{ 
            String sql = "UPDATE `appusertable` SET password = + ? + WHERE userName = ?";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setString(1, newPass);
            pstmt.setString(2, userName);
            pstmt.executeUpdate(sql);
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
            closeDBConnection();
        }
    }

    public void changeUserName(String userName, String newUName) {
        try{ 
            String sql = "UPDATE `appusertable` SET userName = + ? + WHERE userName = ?";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setString(1, newUName);
            pstmt.setString(2, userName);
            pstmt.executeUpdate();
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
            closeDBConnection();
        }
    }

    public void changeEmail(String userName, String newEmail) {
        try{ 
            String sql = "UPDATE `appusertable` SET email = + ? + WHERE userName = ?";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setString(1, newEmail);
            pstmt.setString(2, userName);
            pstmt.executeUpdate(sql);
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
            closeDBConnection();
        }
    }

    public void deleteUser(String userName) {
        try{
            String sql = "DELETE FROM `appusertable` WHERE userName = ?";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setString(1, userName);
            pstmt.executeUpdate(sql);
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error deleting a user: " + e.getMessage());
            closeDBConnection();
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

