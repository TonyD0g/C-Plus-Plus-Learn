#include<stdio.h>
void main()
{
	int x,a[100],i;
	void sort(int a[],int n);
	printf("Input n:");
	scanf("%d",&x);
	printf("Input array of %d integers:",x);
	for(i=0;i<x;i++)
	{
		scanf("%d",&a[i]);
	
	}
		sort(a,x);
	
}
void sort(int a[],int n)
{
	int i,j,t;
	for(i=0;i<n-1;i++)
	for(j=i+1;j<n;j++)
	{
		if(a[i]>a[j])
		{
			t=a[i];
			a[i]=a[j];
			a[j]=t;
		}
		
	}
	printf("After sorted the array is:");
	for(i=0;i<n;i++)
		{
			printf("%d ",a[i]);
		}
}

