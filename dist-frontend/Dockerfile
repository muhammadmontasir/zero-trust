# dist-frontend/Dockerfile
FROM nginx:alpine

# Copy angular dist files into NGINX public directory
COPY . /usr/share/nginx/html/

# Copy nginx configuration
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80