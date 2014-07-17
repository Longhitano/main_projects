/* 
 * FINAL YEAR PROJECT
 * 
 * Author: Andrea Longhitano, W1345392
 * University of Westminster - Software Engineering
 * Description: An RTP sniffer that also redirects and drops packets in order to simulate bad networks
 * Date of last modification: 18/04/2014
 * Version: 1.2
 * 
 * 
 */



package j1;

	
import java.net.InetAddress;
import java.net.UnknownHostException;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;
import org.jnetpcap.Pcap;
import org.jnetpcap.PcapIf;
import org.jnetpcap.packet.JMemoryPacket;
import org.jnetpcap.packet.Payload;
import org.jnetpcap.packet.PcapPacket;
import org.jnetpcap.packet.PcapPacketHandler;
import org.jnetpcap.packet.format.FormatUtils;
import org.jnetpcap.protocol.lan.Ethernet;
import org.jnetpcap.protocol.network.Arp;
import org.jnetpcap.protocol.tcpip.Udp;
import org.jnetpcap.protocol.voip.*;
import org.jnetpcap.protocol.network.Ip4;

 
public class lizardous {
 
    public static void main(String[] args) {
        try {
            // This list is going to return all the devices which can be used for the capture
        	List<PcapIf> alldevs = new ArrayList<PcapIf>(); 
 
            // For error messages
            StringBuilder errbuf = new StringBuilder();
 
          
            // This loops is used to calculate the list of devices that can be used
            int r = Pcap.findAllDevs(alldevs, errbuf);
            System.out.println(r);
            
            if (r != Pcap.OK) 
            {
                System.err.printf("Can't read list of devices, error is %s", errbuf.toString());
                return;
            }
 
            System.out.println("Network devices found:");
            
            int i = 0; // Counter for the loop
            
            
            for (PcapIf device : alldevs) 
            {
                String description = (device.getDescription() != null) ? device.getDescription() : "No description available";
                System.out.printf("#%d: %s [%s]\n", i++, device.getName(), description);
            }
            
            System.out.println("choose the one device from above list of devices");
            int ch = new Scanner(System.in).nextInt();
            PcapIf device =  alldevs.get(ch);
 
            int snaplen = 64 * 1024;           // Capture all packets, no truncation
            int flags = Pcap.MODE_PROMISCUOUS; // capture all packets
            int timeout = 100 * 1000;           // 10 seconds in milliseconds
 
            //Open the selected device to capture packets
            final Pcap pcap = Pcap.openLive(device.getName(), snaplen, flags, timeout, errbuf);
 
            if (pcap == null) 
            {
                System.err.printf("Error while opening device for capture: "
                        + errbuf.toString());
                return;
            }
            System.out.println("device opened");
 
       
            PcapPacketHandler<String> handler = new PcapPacketHandler<String>() 
            {    
            
            	/* This object is used to filter the stream.
            	 * Since it has been implemented in other libraries
            	 * the author could use all the native methods
            	 */
            	
            	Rtp rtp = new Rtp();
            	int counter=0;
            	
            	public void nextPacket(PcapPacket packet, String user) {  
            		
            		/*  In the following loop the incoming packet is
            		 *  tested against the "if" statement to check if
            		 *  its protocol is RTP. In that case the packet will
            		 *	be kept and modified.
            		 */
            		
                      if (packet.hasHeader(rtp)) 
                      {
                    	  System.out.println("An RTP packet has just been captured:");
                          System.out.println("Packet Header :   " + rtp.getHeader().toString());
                          
                          // These other methods are used for testing/troubleshooting

                          //System.out.println("Packet Details :  " + rtp.getPacket()); 
                          //System.out.println("Payload Details : \n"+ rtp.getPayload());
                          
                          
                          //Start Packet Modification
                          packet.scan(Ethernet.ID); //Needs to be done before doing any editing

                          //Editing the ethernet layer
                          Ethernet eth = new Ethernet(); 
                          
                          
                          //Editing the Ip layer
                          Ip4 ip = packet.getHeader(new Ip4());
                          
                          // Here the source and destination are changed, 
                          // in order to send the packet to a new destination.
                          ip.source(new byte[] {10, (byte)100,(byte)114, (byte)179}); 

                          //The following if statement can be uncommented to drop 1 packet out of 5
                          
                          if(counter%5 == 0){ip.destination(new byte[] {(byte)192,(byte)168,19,9}); }
                          else {
                        	  		//ip.destination(new byte[] {(byte)192,(byte)168,0,11});
                          			ip.destination(new byte[] {10,(byte)100, (byte)114 ,(byte)178});
                          	 } 
                          ip.checksum(ip.calculateChecksum());
                          
                          //Editing the Udp layer
                           Udp udp = packet.getHeader(new Udp());
                          udp.checksum(udp.calculateChecksum());
                       
                          
                          //Editing the Rtp layer
                     //    Rtp rtp = packet.getHeader(new Rtp());
                         
                          // Destination port
                          udp.destination(5010);
                          
                        packet.scan(Ethernet.ID); // End of packet modification
                           
                        counter++;
                        System.out.println("Packet redirected");
                          // If the packet cannot be sent, output error
                          if (pcap.sendPacket(packet) != Pcap.OK) 
                          {
                        	    System.err.println(pcap.getErr());
                          }
                      } 
                      
                      // If the packet is not RTP, discard it
                      if(!packet.hasHeader(rtp)) 
                      {
                    	  System.out.println( "This is not an RTP packet so it will not be analysed ");
                    	  
                      }
                      
            	  }  
            	} ;
            	
            	
            // This loop will capture 8000 packets, if you want to use a different number just change the first argument
          pcap.loop(8000, handler, "jnetpcap rocks!");
          
            //Close the pcap
            pcap.close();
        } 
        catch (Exception ex) 
        	{
            System.out.println(ex);
            }
    }
}

