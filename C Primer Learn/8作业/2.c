#include<stdio.h>
int main()
{
	int i,n,t,a[6];
	int *p,*z;
	printf("input array data:\n");
	for(i=0;i<5;i++)
	{
		scanf("%d ",&a[i]);
	}
	printf("input insert data:\n");
		scanf("%d",&a[5]);
		for(n=5;n>=0;n--)
		{
			p=&a[n]+1;
			z=&a[n];
			if(*p<*z)
			{
				t=a[n];
				a[n]=a[n+1];
				a[n+1]=t;
			}
		}
		for(i=0;i<6;i++)
		{
			printf("%d ",a[i]);
		}
}
