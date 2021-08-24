#include<stdio.h>
#include<string.h>
void strmcpy(char *s,char *t,int m)
{
	strcpy(s,t +m -1);
}
int main()
{
	char s[100],t[100];
	int m;
	printf("Input a string:");
	gets(t);
	printf("Input an integer:");
	scanf("%d",&m);
	strmcpy(s,t,m);
	printf("Output is:");
	puts(s);
	return 0;

}
