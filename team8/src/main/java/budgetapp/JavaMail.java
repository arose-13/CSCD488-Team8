package budgetapp;

import java.util.*;
import javax.mail.*;
import javax.mail.internet.*;
import javax.activation.*;
import javax.mail.Session;
import javax.mail.Transport;


public class JavaMail {
    public static void main(String[] args) throws Exception {
        // email ID of Recipient.
      String recipient = "team.eight.noreply@gmail.com";
 
      // email ID of  Sender.
      String sender = "team.eight.noreply@gmail.com";
 
      // using host as localhost
      String host = "smtp.gmail.com";
 
      // Getting system properties
      Properties properties = new Properties();
 
      // Setting up mail server
      properties.put("mail.smtp.ssl.protocols", "TLSv1.2");
      properties.put("mail.smtp.auth", "true");
      properties.put("mail.smtp.starttls.enable", "true");
      properties.put("mail.smtp.host", host);
      properties.put("mail.smtp.port", "587");
      
 
      // creating session object to get properties
      Session session = Session.getInstance(properties, new Authenticator() {
        @Override
        protected PasswordAuthentication getPasswordAuthentication() {
            return new PasswordAuthentication("team.eight.noreply@gmail.com", "ipystdmpjnhutxyq");
        }
      });
 
      try
      {
         // MimeMessage object.
         MimeMessage message = new MimeMessage(session);
 
         // Set From Field: adding senders email to from field.
         message.setFrom(new InternetAddress(sender));
 
         // Set To Field: adding recipient's email to from field.
         message.addRecipient(Message.RecipientType.TO, new InternetAddress(recipient));
 
         // Set Subject: subject of the email
         message.setSubject("This is Subject");
 
         // set body of the email.
         message.setText("This is a test mail");
 
         // Send email.
         Transport.send(message);
         System.out.println("Mail successfully sent");
      }
      catch (MessagingException mex)
      {
         mex.printStackTrace();
      }
    }
}
