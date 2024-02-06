# Use Ubuntu 20.04 as base image
FROM ubuntu:20.04

# Update apt package index and install necessary dependencies
RUN apt-get update && \
    apt-get install -y curl sudo && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install Node.js 18.x
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
RUN apt-get install -y nodejs

# Set working directory
WORKDIR /app

# Copy your program from host to the container
COPY ai/SillyTavern/ /app/

# Expose port 777
EXPOSE 777

# Run your program with sudo
CMD ["sudo", "/bin/bash", "/app/start.sh"]

