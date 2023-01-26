package budgetapp.resources;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import budgetapp.appUser.AppUser;
import budgetapp.javaEmail.*;

@Path("/JavaEmail")
public class JavaEmailResource {

    @GET
    @Path("/emailTest")
    @Produces(MediaType.APPLICATION_JSON)
    public String javaEmailTest() throws Exception {
        java.util.Date d = new java.util.Date();
        System.out.println(d);
        java.sql.Date date = new java.sql.Date(d.getTime());
        String subDate = date.toString();

        AppUser test = new AppUser("testName", "testPassNotHash", "team.eight.noreply@gmail.com", subDate);
        JavaMail myMail = new JavaMail(test);
        String verificationCode = myMail.sendAuthenticationEmail(test);
        System.out.println(verificationCode);
        return verificationCode;
    }

    @GET
    @Produces(MediaType.TEXT_PLAIN)
    public String testString() throws Exception {
        return "JavaEmail GET";
    }
}
