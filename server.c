#include <stdio.h>
#include <stdlib.h>
#include <netdb.h>
#include <netinet/in.h>
#include <string.h>

int main(int argc, char const *argv[])
{
	int sockfd, newsockfd, portno, clilen;
	char buffer[256];
	struct sockaddr_in serv_addr, cli_addr;
	int n;

	sockfd = socket(AF_INET, SOCK_STREAM, 0);
	if(sockfd < 0) {
		perror("Error opening socket");
		exit(1);
	}

	bzero((char *) &serv_addr, sizeof(serv_addr));

	portno = 5001;

	serv_addr.sin_family = AF_INET;
	serv_addr.sin_addr.s_addr = INADDR_ANY;
	serv_addr.sin_port = htons(portno);

	if(bind(sockfd, (struct sockaddr *) &serv_addr, sizeof(serv_addr)) < 0) {
		perror("Error binding socket");
		exit(2);
	}
	
	listen(sockfd, 5);
	clilen = sizeof(cli_addr);

	newsockfd = accept(sockfd, (struct sockaddr *) &cli_addr, sizeof(cli_addr));
	if(newsockfd < 0) {
		perror("Error on accept");
		exit(3);
	}

	bzero(buffer, 256);
	n = read(newsockfd, buffer, 255);
	if(n < 0) {
		perror("Error reading from socket");
		exit(4);
	}

	n = write(newsockfd, "I got your message", 18);
	if(n < 0) {
		perror("Error on write");
		exit(5);	
	}
	
	return 0;
}