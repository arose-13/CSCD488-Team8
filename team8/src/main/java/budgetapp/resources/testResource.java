package budgetapp.resources;

import jakarta.ws.rs.GET;
import jakarta.ws.rs.Path;
import jakarta.ws.rs.Produces;
import jakarta.ws.rs.core.MediaType;

@Path("/test")
public class testResource {

    @GET
    @Produces(MediaType.TEXT_PLAIN)
    public String getTest() {
        return "hello worldz";
    }
}
