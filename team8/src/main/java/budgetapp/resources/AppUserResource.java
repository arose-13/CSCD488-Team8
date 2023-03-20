package budgetapp.resources;

import javax.validation.constraints.Email;
import javax.ws.rs.DELETE;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import budgetapp.appUser.AppUser;
import budgetapp.appUser.UserData;
import budgetapp.databaseConnection.JavaDBConnect;

@Path("/user")
public class AppUserResource {

    @GET
    @Path("/test")
    @Produces(MediaType.APPLICATION_JSON)
    public AppUser makeUser() throws Exception {
        long mills = System.currentTimeMillis();
        java.sql.Date date = new java.sql.Date(mills);
        String inputDate = String.valueOf(date);
        AppUser newUser = new AppUser("testName", "testPassNotHash", "team.eight.noreply@gmail.com", inputDate, 15.15,
                10.10);

        return newUser;
    }

    @PUT
    @Path("/newUser/{uname}/{email}/{pwd}")
    @Produces(MediaType.APPLICATION_JSON)
    public AppUser makeNewUser(@PathParam("uname") String uname, @PathParam("email") String email,
            @PathParam("pwd") String pwd) throws Exception {
        long mills = System.currentTimeMillis();
        java.sql.Date date = new java.sql.Date(mills);
        String inputDate = String.valueOf(date);
        AppUser newUser = new AppUser(uname, pwd, email, inputDate);
        try {
            JavaDBConnect myConnection = new JavaDBConnect();
            return myConnection.createNewUser(newUser);
        } catch (Exception e) {
            System.out.println("User Creation Failed");
        }
        throw new Exception();
    }

    // this is logging in
    @GET
    @Path("/getUser/{email}/{pwd}")
    @Produces(MediaType.APPLICATION_JSON)
    public AppUser getUser(@PathParam("email") String email, @PathParam("pwd") String pwd) throws Exception {
        try {
            JavaDBConnect myConnection = new JavaDBConnect();
            // AppUser fetchedUser = myConnection.createAppUser(pwd, email); Missing Method
            return null;
        } catch (Exception e) {
            System.out.println("User Not Found");
        }
        throw new Exception("User Not Found");
    }

    // Verification email should be done before this is curl
    @DELETE
    @Path("/deleteUser/{uname}/{email}")
    @Produces(MediaType.APPLICATION_JSON)
    public boolean deleteUser(@PathParam("uname") String uname, @PathParam("email") String email) throws Exception {
        try {
            JavaDBConnect myConnection = new JavaDBConnect();
            myConnection.deleteUser(uname, email, null);
            // Method needs to be modified to not require date?
            return true;
        } catch (Exception e) {
            System.out.println("User Not Found");
        }
        return false;
    }

    // Verification email should be done before this is curl
    @PUT
    @Path("/changeUserEmail/{uname}/{email}/{newEmail}")
    @Produces(MediaType.APPLICATION_JSON)
    public boolean changeUserEmail(@PathParam("uname") String uname, @PathParam("email") String email,
            @PathParam("newEmail") String newEmail) throws Exception {
        try {
            JavaDBConnect myConnection = new JavaDBConnect();
            myConnection.changeEmail(uname, newEmail, email, null);
            // Method needs to be modified to not require Date
            return true;
        } catch (Exception e) {
            System.out.println("User Not Found");
        }
        return false;
    }

    // Verification email should be done before this is curl
    @PUT
    @Path("/changeUserName/{uname}/{email}/{newName}")
    @Produces(MediaType.APPLICATION_JSON)
    public boolean changeUserName(@PathParam("uname") String uname, @PathParam("email") String email,
            @PathParam("newName") String newName) throws Exception {
        try {
            JavaDBConnect myConnection = new JavaDBConnect();
            myConnection.changeUserName(uname, newName, email, null);
            // Method needs to be modified to not require Date
            return true;
        } catch (Exception e) {
            System.out.println("User Not Found");
        }
        return false;
    }

    // Verification email should be done before this is curl
    @PUT
    @Path("/changeUserName/{uname}/{email}/{newPwd}")
    @Produces(MediaType.APPLICATION_JSON)
    public boolean changeUserPwd(@PathParam("uname") String uname, @PathParam("email") String email,
            @PathParam("newPwd") String newPwd) throws Exception {
        try {
            JavaDBConnect myConnection = new JavaDBConnect();
            myConnection.changePassword(uname, newPwd, email, null);
            // Method needs to be modified to not require Date
            return true;
        } catch (Exception e) {
            System.out.println("User Not Found");
        }
        return false;
    }

    @PUT
    @Path("/updateUserData/{uname}/{email}/{data}")
    @Produces(MediaType.APPLICATION_JSON)
    public boolean changeUserPwd(@PathParam("uname") String uname, @PathParam("email") String email,
            @PathParam("data") UserData[] data) throws Exception {
        try {
            JavaDBConnect myConnection = new JavaDBConnect();
            myConnection.updateUserData(uname, email, null, data);
            // Method needs to be modified to not require Date
            return true;
        } catch (Exception e) {
            System.out.println("User Not Found");
        }
        return false;
    }

    @GET
    @Produces(MediaType.TEXT_PLAIN)
    public String testString() throws Exception {
        return "user GET";
    }
}
