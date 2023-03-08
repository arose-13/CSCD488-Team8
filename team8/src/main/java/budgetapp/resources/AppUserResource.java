package budgetapp.resources;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import budgetapp.appUser.AppUser;
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
        AppUser newUser = new AppUser("testName", "testPassNotHash", "team.eight.noreply@gmail.com", inputDate, 15.15, 10.10);
        
        return newUser;
    }

    @GET
    @Path("/newUser/{uname}/{email}/{pwd}")
    @Produces(MediaType.APPLICATION_JSON)
    public AppUser makeNewUser(@PathParam("uname")String uname,@PathParam("email")String email,@PathParam("pwd")String pwd) throws Exception {
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

    @GET
    @Produces(MediaType.TEXT_PLAIN)
    public String testString() throws Exception {
        return "user GET";
    }
}
