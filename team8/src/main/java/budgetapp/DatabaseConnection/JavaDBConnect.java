package budgetapp.DatabaseConnection;

import java.sql.*;

public class JavaDBConnect {
    //Sanity Check with Java -> mysql db connection
    public static void main(String[] args) {
        String dbURL = "jdbc:mysql://localhost:3306/budgetappuser";
        String username = "sqluser";
        String password = "Team8Password";
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            Connection connection = DriverManager.getConnection(dbURL, username, password);
            Statement statement = connection.createStatement();
            ResultSet resultSet = statement.executeQuery("select * from `appusertable`");

            while (resultSet.next()) {
                System.out.println(resultSet.getInt(1)+" | "+resultSet.getString(2)+" | "+resultSet.getString(3)+" | "+resultSet.getString(4));
            }

            connection.close();

            // Output expected
            // 1 | testUser | notHashedPW | testEmail@email.com
            // 2 | testUser2 | notHashedPW2 | testEmail@email.com2

        } catch (Exception e) {
            System.out.println(e);
        }
    }
}
