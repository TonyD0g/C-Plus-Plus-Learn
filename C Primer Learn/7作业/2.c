#include<stdio.h>
void main()
{
	int	f(int x);
	int z,x;
	scanf("%d",&x);
	printf("Input n:");
	z=f(x);
	if(z==1)
	{
		printf("%d is prime\n",x);
	}
	else
		printf("%d is not prime\n",x);
}
int f(int x)
{
	int z=0,i;
	for(i=1;i<=x;i++)
	{
		if(x%i==0)
		{
			z=z+1;
		}
	}
	if(z>2)
	{
		return 0;
	}
	else
		return 1;
}


