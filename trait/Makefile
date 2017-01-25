CSRC := $(wildcard *.c)
CPPSRC := $(wildcard *.cpp)
JAVASRC = $(wildcard *.java)
CC := $(CSRC:.c=.o)
CPPC := $(CPPSRC:.cpp=.run)
JAVAC := $(JAVASRC:.java=.class)

all: $(CC) $(CPPC) $(JAVAC)

%.o: %.c
	gcc $^ -o $@

%.run: %.cpp
	g++ $^ -o $@

%.class: %.java
	javac $^

clean:
	rm -f *.o *.run *.txt *.class
