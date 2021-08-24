#include<stdio.h>
void main()
{
	int a[100],i,n;
	int b;
	void search(int a[],int n,int b);
	printf("Input n:");
	scanf("%d",&n);
	printf("Input %d integers:",n);
	for(i=0;i<n;i++)
	{
		scanf("%d",&a[i]);
	}
	printf("Input x:");
	scanf("%d",&b);
	search(a,n,b);
}
void search(int a[],int n,int b)
{
	int i,z=0;
	for(i=0;i<n;i++)
	{
		if(a[i]==b)
		{
			printf("index = %d\n",i);
			z=z+1;
			break;
		}
	}
	if(z==0)
	{
		printf("Not found\n");
	}
}

