# Imagen oficial de Node.js ligera
FROM node:20-alpine

# Directorio de trabajo dentro del contenedor
WORKDIR /usr/src/app

# Copiar archivos de configuración de dependencias
COPY package*.json ./

# Instalar dependencias
RUN npm install

# Copiar el resto del código
COPY . .

# Expone el puerto configurado en Express
EXPOSE 3000

# Comando para ejecutar la aplicación
CMD ["npm", "run", "dev"]