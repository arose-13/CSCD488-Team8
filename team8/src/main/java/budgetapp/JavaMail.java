package budgetapp;

import java.util.*;
import javax.mail.*;
import javax.mail.internet.*;
import javax.activation.*;
import javax.mail.Session;
import javax.mail.Transport;

public class JavaMail {
  private String toEmail = "team.eight.noreply@gmail.com";
  private final String fromEmail = "team.eight.noreply@gmail.com";
  private Session session;
  private MimeMessage msg;
  private String type = "default";

  public JavaMail() throws Exception {
    this.session = setUpEmailSession();
    this.msg = new MimeMessage(this.session);
  }

  public JavaMail(final String to) throws Exception {
    this();
    this.toEmail = to;
  }

  public JavaMail(final String to, final String type) throws Exception {
    this(to);
    this.type = type; // May need to wash input.
  }

  public static void main(String[] args) throws Exception {
    JavaMail myMail = new JavaMail("team.eight.noreply@gmail.com", "deleteAccount");
    //JavaMail myMail = new JavaMail("nathannelsondude@gmail.com", "deleteAccount");
    try {
      if (myMail.type == "default") {
        myMail.setMessage("default subject", "default body");
      } else if (myMail.type == "authentication") {
        myMail.setMessage("Account Authentication", "Account Authentication Default Text");

      } else if (myMail.type == "deleteAccount") {
        myMail.setMessage("Account Deletion", "Account Deletion Default Text");
      } else {
        System.out.println("myMail.type not valid");
        throw new Exception();
      }
      Transport.send(myMail.msg);
      System.out.println("Mail successfully sent");
    } catch (MessagingException mex) {
      mex.printStackTrace();
    }
  }

  private void setMessage(final String subject, final String body) throws Exception {
    // set message headers
    this.msg.addHeader("Content-type", "text/HTML; charset=UTF-8");
    this.msg.addHeader("format", "flowed");
    this.msg.addHeader("Content-Transfer-Encoding", "8bit");

    this.msg.setFrom(new InternetAddress(this.fromEmail, "Team8 NoReply"));

    this.msg.setReplyTo(InternetAddress.parse(this.fromEmail, false));

    this.msg.setSubject(subject, "UTF-8");

    this.msg.setText(body, "UTF-8");

    this.msg.setSentDate(new Date());

    this.msg.setRecipients(Message.RecipientType.TO, InternetAddress.parse(this.toEmail, false));
    System.out.println("Message is ready");
  }

  private Session setUpEmailSession() throws Exception {
    try {
      // using host as localhost
      final String host = "smtp.gmail.com";

      // Getting system properties
      Properties properties = new Properties();

      // Setting up mail server / setting properties
      properties.put("mail.smtp.ssl.protocols", "TLSv1.2");
      properties.put("mail.smtp.auth", "true");
      properties.put("mail.smtp.starttls.enable", "true");
      properties.put("mail.smtp.host", host);
      properties.put("mail.smtp.port", "587");

      // creating session object to get properties
      final Session session = Session.getInstance(properties, new Authenticator() {
        @Override
        protected final PasswordAuthentication getPasswordAuthentication() {
          return new PasswordAuthentication("team.eight.noreply@gmail.com", "ipystdmpjnhutxyq");
        }
      });
      return session;
    } catch (Exception e) {
      System.out.println("error setting up email server connection\n");
      throw new Exception(e);
    }
  }
}
