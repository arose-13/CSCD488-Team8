package budgetapp.resources;

import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

@Path("/test")
public class TestResource {

    @GET
    @Produces(MediaType.TEXT_PLAIN)
    public String testString() {
        return "Hello Worldz Test";
    }

    @POST
    @Path("/return-test")
    @Produces(MediaType.TEXT_PLAIN)
    public String returnTest(String data) {
        if (data != null)
            return "You sent '" + data + "'";
        return "'data' is null!";
    }
}
