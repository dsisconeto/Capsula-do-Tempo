Depois de ter instalando o **GO** e o **MongoDB**


Instalando Dep https://github.com/golang/dep

````sh
go get -u github.com/golang/dep/cmd/dep

````

Criando pasta do projeto

````sh 
mkdir -p $GOPATH/src/github.com/dsisconeto
````

Movendo se para Pasta

````sh 
cd $GOPATH/src/github.com/dsisconeto
````

Clonando o repositorio

````sh 
git clone https://github.com/dsisconeto/localmarket.git
````

Movendo se para pata do projeto

````sh 
cd ./localmarket 
````

Instalando Dependencias

````sh 
dep ensure
````

Renomendo arquivo de Environment, depois é só configurar o environment

````sh 
cp ./.env-example ./.env
````

Para Rodar

````sh 
go run main.go
````

Para Compilar

````sh 
go build main.go
````

