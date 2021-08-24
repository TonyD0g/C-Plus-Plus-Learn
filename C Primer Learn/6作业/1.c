#include<stdio.h>
fact(int n)
{
	int i;
	long p=1;
	for(i=1;i<=n;i++)
	{
		p=p*i;
	}
	return p;
}
int main()
{
	int n,i,p;
	printf("Enter n: ");
	scanf("%d",&n);
	for(i=1;i<=n;i++)
	{
		p=fact(i);
		printf("%d!=%d\n",i,p);
	}
	return 0;
}
