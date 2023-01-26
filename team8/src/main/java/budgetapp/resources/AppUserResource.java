package budgetapp.resources;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import budgetapp.appUser.AppUser;

@Path("/user")
public class AppUserResource {
    
    @GET
    @Path("/make")
    @Produces(MediaType.APPLICATION_JSON)
    public AppUser makeUser() throws Exception {
        java.util.Date d = new java.util.Date();
        java.sql.Date date = new java.sql.Date(d.getTime());
        String subDate = date.toString();
        AppUser newUser = new AppUser("testName", "testPassNotHash", "team.eight.noreply@gmail.com", subDate);
        return newUser;
    }

    @GET
    @Produces(MediaType.TEXT_PLAIN)
    public String testString() throws Exception {
        return "user GET";
    }
}
