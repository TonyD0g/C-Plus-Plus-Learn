#include<stdio.h>
#include<string.h>
void delchar(char s[100],char c)
{
	char a[100];
	int i,j;
	j=0;
	for(i=0;i<strlen(s);i++)
		if(s[i]!=c)
			a[j++]=s[i];


		a[j]='\0';
		printf("After deleted,the string is:");
		puts(a);
}
int main()
{
	char s[100],c;
	printf("Input a string:");
	gets(s);
	printf("Input a char:");
	scanf("%c",&c);
	delchar(s,c);
	return 0;
}

