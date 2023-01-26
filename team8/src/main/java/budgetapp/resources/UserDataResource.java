package budgetapp.resources;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import budgetapp.appUser.UserData;

@Path("/udr")
public class UserDataResource {

    @GET
    @Path("/test")
    @Produces(MediaType.APPLICATION_JSON)
    public UserData testReturn() {
        UserData test = new UserData(15.15, 20.99);
        return test;
    }

    @GET
    @Produces(MediaType.TEXT_PLAIN)
    public String testString() throws Exception {
        return "udr GET";
    }
}
