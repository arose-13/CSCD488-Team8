package budgetapp.resources;

import javax.ws.rs.GET;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

import budgetapp.appUser.AppUser;
import budgetapp.javaEmail.*;

@Path("/JavaEmail")
public class JavaEmailResource {

    @GET
    @Path("/test")
    @Produces(MediaType.APPLICATION_JSON)
    public String javaEmailTest() throws Exception {
        long d = System.currentTimeMillis();
        java.sql.Date date = new java.sql.Date(d);
        String inputDate = String.valueOf(date);
        AppUser test = new AppUser("testName", "testPassNotHash", "team.eight.noreply@gmail.com", inputDate);
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

    @PUT
    @Path("/auth/{email}")
    @Produces(MediaType.APPLICATION_JSON)
    public String authenticateEmail(@PathParam("email")String email)throws Exception {
        String userEmail = email;
        try {
            JavaMail authMail = new JavaMail(userEmail);
            return authMail.sendAuthenticationEmail();
        } catch (Exception e) {
            System.out.println("User auth Email Failed");
        }
        throw new Exception();
    }
}
