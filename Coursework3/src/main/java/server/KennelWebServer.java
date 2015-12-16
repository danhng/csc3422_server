package server;

import org.apache.tomcat.InstanceManager;
import org.apache.tomcat.SimpleInstanceManager;
import org.eclipse.jetty.annotations.ServletContainerInitializersStarter;
import org.eclipse.jetty.apache.jsp.JettyJasperInitializer;
import org.eclipse.jetty.plus.annotation.ContainerInitializer;
import org.eclipse.jetty.server.Server;
import org.eclipse.jetty.servlet.ServletHolder;
import org.eclipse.jetty.webapp.WebAppContext;
import server.crypto.Crypto;
import server.io.IO;
import server.user.User;

import java.net.URISyntaxException;
import java.util.*;

public class KennelWebServer {
    public static void main(String[] args) throws URISyntaxException {
        Server server = new Server(8080);
        // initialise server
        initialiseServer();

        WebAppContext context = new WebAppContext();
        context.setContextPath("/");
        context.setResourceBase(KennelWebServer.class.getResource("/webapp/").toURI().toASCIIString());
        final ContainerInitializer initializer = new ContainerInitializer(new JettyJasperInitializer(), null);
        List<ContainerInitializer> initializers = new ArrayList<ContainerInitializer>(){{add(initializer);}};
        context.setAttribute("org.eclipse.jetty.containerInitializers", initializers);
        context.setAttribute(InstanceManager.class.getName(), new SimpleInstanceManager());
        context.addBean(new ServletContainerInitializersStarter(context), true);

        ServletHolder kennelHolder = new ServletHolder("kennel", IndexServlet.class);

        context.addServlet(kennelHolder, "/");
        server.setHandler(context);
        try {
            server.start();

        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }

    /**
     * initialise server with storage files.
     */
    private static void initialiseServer() {
        // write the key to secondary storage
        IO.getStructureFromFile(Config.secretKey, Crypto.randomKey());
        // write active file to secondary storage
        IO.writeSerialisedObject(Config.activeFile, new HashSet<String>());
        // write auth file to secondary storage
        HashMap<String, String> users = IO.getStructureFromFile(Config.authFile, new HashMap<String, String>());
        // initialise user info (clears up) for usernames signed up
        for (Map.Entry<String, String> user: users.entrySet()) {
            IO.writeSerialisedObject(User.getFileInfoName(user.getKey()), new HashMap<String, String>());
        }
    }
}