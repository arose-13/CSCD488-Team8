package budgetapp.resources;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import budgetapp.databaseConnection.JavaDBConnect;

@Path("/jdb")
public class JavaDBResource {
    
    @GET
    @Path("/test")
    @Produces(MediaType.APPLICATION_JSON)
    public String testJDB() {
        JavaDBConnect myDBConnection = new JavaDBConnect();
        return "";
    }

    @GET
    @Produces(MediaType.TEXT_PLAIN)
    public String testString() throws Exception {
        return "jdb GET";
    }

}
