package budgetapp.databaseConnection;

import java.sql.*;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;

import budgetapp.appUser.AppUser;
import budgetapp.appUser.UserData;

import java.util.Date;

public class JavaDBConnect {
    private static Connection connection;
    private static final String DB_URL = "jdbc:mysql://localhost:3306/budgetappuser";
    private static final String USERNAME = "username";
    private static final String PASSWORD = "password";

    public JavaDBConnect() {
        connectToDB();
    }

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
                System.out.println(resultSet.getInt(1)+" | "+resultSet.getString(2)+" | "+resultSet.getString(3)+" | "+resultSet.getString(4)); //and not leak passwords
            }
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error fetching all users: " + e.getMessage());
            closeDBConnection();
        }
    }

    public UserData[] updateUserData(AppUser user) throws JsonProcessingException {
        updateUserData(user.getuName(), user.getEmail(), user.getuDate(), user.getData());
        return user.getData();
    }


    private void updateUserData(String userName, String email, Date createDate, UserData[] data) throws JsonProcessingException {
        try {
            String sql = "UPDATE `appusertable` SET `m01`=?, `m02`=?, `m03`=?, `m04`=?, `m05`=?, `m06`=?, `m07`=?, `m08`=?, `m09`=?, `m10`=?, `m11`=?, `m12`=? WHERE `userName`=? AND `email`=? AND `userCreationDate`=?;";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            ObjectMapper objMapper = new ObjectMapper(); 
            pstmt.setObject(1, objMapper.writeValueAsString(data[0]));
            pstmt.setObject(2, objMapper.writeValueAsString(data[1]));
            pstmt.setObject(3, objMapper.writeValueAsString(data[2]));
            pstmt.setObject(4, objMapper.writeValueAsString(data[3]));
            pstmt.setObject(5, objMapper.writeValueAsString(data[4]));
            pstmt.setObject(6, objMapper.writeValueAsString(data[5]));
            pstmt.setObject(7, objMapper.writeValueAsString(data[6]));
            pstmt.setObject(8, objMapper.writeValueAsString(data[7]));
            pstmt.setObject(9, objMapper.writeValueAsString(data[8]));
            pstmt.setObject(10, objMapper.writeValueAsString(data[9]));
            pstmt.setObject(11, objMapper.writeValueAsString(data[10]));
            pstmt.setObject(12, objMapper.writeValueAsString(data[11]));
            pstmt.setString(13, userName);
            pstmt.setString(14, email);
            pstmt.setObject(15, createDate);
            pstmt.executeUpdate();
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error creating a user: " + e.getMessage());
            closeDBConnection();
        }
    }

    public AppUser createNewUser(AppUser newUser) throws JsonProcessingException {
        createNewUser(newUser.getuName(), newUser.getPassword(), newUser.getEmail(), newUser.getuDate(), newUser.getData());
        return newUser;
    }

    private void createNewUser(String userName, String password, String email, Date createDate, UserData[] data) throws JsonProcessingException {
        try {
            //check if user already exits
            if (countSearchResults(userName, email, createDate) == 0) {
                String sql = "INSERT INTO `appusertable` (`m01`, `m02`, `m03`, `m04`, `m05`, `m06`, `m07`, `m08`, `m09`, `m10`, `m11`, `m12`, `userName`, `password`, `email`, `userCreationDate`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                PreparedStatement pstmt = connection.prepareStatement(sql);
                ObjectMapper objMapper = new ObjectMapper();
                pstmt.setObject(1, objMapper.writeValueAsString(data[0]));
                pstmt.setObject(2, objMapper.writeValueAsString(data[1]));
                pstmt.setObject(3, objMapper.writeValueAsString(data[2]));
                pstmt.setObject(4, objMapper.writeValueAsString(data[3]));
                pstmt.setObject(5, objMapper.writeValueAsString(data[4]));
                pstmt.setObject(6, objMapper.writeValueAsString(data[5]));
                pstmt.setObject(7, objMapper.writeValueAsString(data[6]));
                pstmt.setObject(8, objMapper.writeValueAsString(data[7]));
                pstmt.setObject(9, objMapper.writeValueAsString(data[8]));
                pstmt.setObject(10, objMapper.writeValueAsString(data[9]));
                pstmt.setObject(11, objMapper.writeValueAsString(data[10]));
                pstmt.setObject(12, objMapper.writeValueAsString(data[11]));
                pstmt.setString(13, userName);
                pstmt.setString(14, password);
                pstmt.setString(15, email);
                pstmt.setObject(16, createDate);
                pstmt.executeUpdate();
            } else {
                System.out.println("User already exists");
            }
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error creating a user: " + e.getMessage());
            closeDBConnection();
        }
    }

    public String changePassword(AppUser user, String newPass) {
        changePassword(user.getuName(), newPass, user.getEmail(), user.getuDate());
        return user.getPassword();
    }

    private void changePassword(String userName, String newPass, String email, Date createDate) { // could eventually send out verification emails prior to changing a field 
        try{
            if (countSearchResults(userName, email, createDate) == 1) {
                String sql = "UPDATE `appusertable` SET `password` = ? WHERE `userName` = ? AND `email` = ? AND `userCreationDate` = ?";
                PreparedStatement pstmt = connection.prepareStatement(sql);
                pstmt.setString(1, newPass);
                pstmt.setString(2, userName);
                pstmt.setString(3, email);
                pstmt.setObject(4, createDate);
                pstmt.executeUpdate();
            } else {
                System.out.println("User doesn't exist or has repeated entries");
            }
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
            closeDBConnection();
        }
    }

    public String changeUserName(AppUser user, String newUName) {
        changeUserName(user.getuName(), newUName, user.getEmail(), user.getuDate());
        return user.getuName();
    }

    private void changeUserName(String userName, String newUName, String email, Date createDate) {
        try{ 
            if (countSearchResults(userName, email, createDate) == 1) {
                String sql = "UPDATE `appusertable` SET `userName` = ? WHERE `userName` = ? AND `email` = ? AND `userCreationDate` = ?";
                PreparedStatement pstmt = connection.prepareStatement(sql);
                pstmt.setString(1, newUName);
                pstmt.setString(2, userName);
                pstmt.setString(3, email);
                pstmt.setObject(4, createDate);
                pstmt.executeUpdate();
            } else {
                System.out.println("User doesn't exist or has repeated entries");
            }
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
            closeDBConnection();
        }
    }

    public String changeEmail(AppUser user, String newEmail) {
        changeEmail(user.getuName(), newEmail, user.getEmail(), user.getuDate());
        return user.getEmail();
    }

    private void changeEmail(String userName, String newEmail, String email, Date createDate) {
        try{ 
            if (countSearchResults(userName, email, createDate) == 1) {
                String sql = "UPDATE `appusertable` SET `email` = ? WHERE `userName` = ? AND `email` = ? AND `userCreationDate` = ?";
                PreparedStatement pstmt = connection.prepareStatement(sql);
                pstmt.setString(1, newEmail);
                pstmt.setString(2, userName);
                pstmt.setString(3, email);
                pstmt.setObject(4, createDate);
                pstmt.executeUpdate();
            } else {
                System.out.println("User doesn't exist or has repeated entries");
            }
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error changing password: " + e.getMessage());
            closeDBConnection();
        }
    }

    public void deleteUser(String userName, String email, Date createDate) {
        try{
            if (countSearchResults(userName, email, createDate) == 1) {
                String sql = "DELETE FROM `appusertable` WHERE `userName` = ? AND `email` = ? AND `userCreationDate` = ?";
                PreparedStatement pstmt = connection.prepareStatement(sql);
                pstmt.setString(1, userName);
                pstmt.setString(2, email);
                pstmt.setObject(3, createDate);
                pstmt.executeUpdate();
            } else {
                System.out.println("User doesn't exist or has repeated entries");
            }
            closeDBConnection();
        } catch (SQLException e) {
            System.out.println("Error deleting a user: " + e.getMessage());
            closeDBConnection();
        }
    }

    public AppUser createAppUser(String userName, String email, Date createDate) {
        try {
            AppUser newUser = new AppUser();
            if (countSearchResults(userName, email, createDate) == 1) {
                String sql = "SELECT `password`, `userCreationDate` FROM `appusertable` WHERE `userName` = ? AND `email` = ? AND `userCreationDate` = ?";
                PreparedStatement pstmt = connection.prepareStatement(sql);
                pstmt.setString(1, userName);
                pstmt.setString(2, email);
                pstmt.setObject(3, createDate);
                ResultSet resultSet = pstmt.executeQuery();
                if (resultSet.next()) {
                    String pWord = resultSet.getString("password");
                    Date utilDate = resultSet.getDate("userCreationDate");

                    newUser.setuName(userName);
                    newUser.setPassword(pWord);
                    newUser.setEmail(email);
                    java.sql.Date sqlDate = new java.sql.Date(utilDate.getTime());
                    newUser.setuDate(sqlDate);
                }
            } else {
                System.out.println("User doesn't exist or has repeated entries");
            }
            closeDBConnection();
            return newUser;
        } catch (SQLException e) {
            System.out.println("Error creating an AppUser object: " + e.getMessage());
            closeDBConnection();
            return null;
        }
    }

    //method that returns the count of search credentials
    public int countSearchResults(String userName, String email, Date createDate) { 
        try {
            String sql = "SELECT COUNT(*) FROM `appusertable` WHERE `userName` = ? AND `email` = ? AND `userCreationDate` = ?";
            PreparedStatement pstmt = connection.prepareStatement(sql);
            pstmt.setString(1, userName);
            pstmt.setString(2, email);
            pstmt.setObject(3, createDate);
            ResultSet resultSet = pstmt.executeQuery();
            if (resultSet.next()) {
                return resultSet.getInt(1);
            }
            return 0;
        } catch (SQLException e) {
            System.out.println("Unable to process ResultSet: " + e.getMessage());
            return 0;
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

    // private void selectAllData() throws SQLException {
    //     Statement statement = connection.createStatement();
    //     ResultSet resultSet = statement.executeQuery("select * from `appusertable`");
    //     while (resultSet.next()) {
    //         System.out.println(resultSet.getInt(1)+" | "+resultSet.getString(2)+" | "+resultSet.getString(3)+" | "+resultSet.getString(4)+" | "+
    //         resultSet.getString(5)+" | "+resultSet.getString(6)+" | "+resultSet.getString(7)+" | "+resultSet.getString(8)+" | "+
    //         resultSet.getString(9)+" | "+resultSet.getString(10)+" | "+resultSet.getString(11)+" | "+resultSet.getString(12)+" | "+
    //         resultSet.getString(13)+" | "+resultSet.getString(14)+" | "+resultSet.getString(15)+" | "+resultSet.getString(16)+" | "+
    //         resultSet.getString(17)+" | "+resultSet.getString(18)+" | "+resultSet.getString(19));
    //     }
    // }

        // public static void main(String[] args) throws SQLException, JsonProcessingException {
    //     JavaDBConnect myConnection = new JavaDBConnect();
    //     AppUser user = new AppUser();
    //     user.setuName("waymond");
    //     user.setPassword("waymondspassword");
    //     user.setEmail("waymond@gmail.com");
    //     long mills = System.currentTimeMillis();
    //     java.sql.Date agreeDate = new java.sql.Date(mills);
    //     user.setuDate(agreeDate);


    //     //myConnection.createNewUser(user);
    //     //myConnection.changeEmail(user, "newemail@niajskdlf.com");
    //     // UserData[] data = new UserData[] { new UserData("a"), new UserData("a"),new UserData("a"),new UserData("a"),new UserData("a"),new UserData("a"),
    //     // new UserData("a"),new UserData("a"),new UserData("a"),new UserData("a"),new UserData("a"),new UserData("a"), };
    //     // AppUser createdUser = myConnection.createAppUser(user.getuName(), user.getEmail(), user.getuDate());
    //     // System.out.println(createdUser);
    //     //myConnection.updateUserData(user);
    //     myConnection.selectAllData();
    //     //closeDBConnection();
    // }




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