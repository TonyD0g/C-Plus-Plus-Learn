#include<stdio.h>
int main()
{
	int a[10],i;
	int *p;
	p=a;
	for(i=0;i<10;i++)
	{
		scanf("%d",p);
		p++;
	}
	p=a;//
	for(i=0;i<10;i++)
	{
		printf("%d",*p);
		p++;
	}
	printf("\n");
}
