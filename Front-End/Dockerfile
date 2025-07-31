# Etapa de build
FROM node:20-alpine as build

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build

# Etapa de producción con Nginx
FROM nginx:stable-alpine

# Limpia la configuración por defecto de Nginx
RUN rm -rf /etc/nginx/conf.d/default.conf

# Copia la configuración personalizada
COPY nginx.conf /etc/nginx/conf.d

# Copia los archivos compilados desde la etapa anterior
COPY --from=build /app/dist /usr/share/nginx/html
