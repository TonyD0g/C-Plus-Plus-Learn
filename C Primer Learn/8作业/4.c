#include<stdio.h>
void main()
{
	int i=0,j=0;
	char s1[100],s2[100];
	printf("input s1:");
	gets(s1);
	printf("input s2:");
	gets(s2);
	while(s1[i]!='\0')
		i++;
	while(s2[j]!='\0')
		s1[i++]=s2[j++];
	s1[i]='\0';
	puts(s1);
}
