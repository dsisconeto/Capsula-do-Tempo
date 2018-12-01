cmake_minimum_required(VERSION 3.7)
project(maze)

set(CMAKE_C_STANDARD 11)
set(CMAKE_RUNTIME_OUTPUT_DIRECTORY ../bin)
set(SOURCE_FILES src/main.c lib/Lista.h lib/Lista.c lib/Fila.h lib/Fila.c lib/Pilha.h lib/Pilha.c lib/Labirinto.c lib/labinrinto.h)
add_executable(maze ${SOURCE_FILES})