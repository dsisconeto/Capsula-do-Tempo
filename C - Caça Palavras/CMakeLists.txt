cmake_minimum_required(VERSION 3.7)
project(procurar_palavras)

set(CMAKE_C_STANDARD 11)
set(CMAKE_RUNTIME_OUTPUT_DIRECTORY ../bin)
set(SOURCE_FILES src/main.c lib/Lista.c lib/Lista.h lib/procurarPalavras.h lib/procurarPalavras.c)
add_executable(procurar_palavras ${SOURCE_FILES})