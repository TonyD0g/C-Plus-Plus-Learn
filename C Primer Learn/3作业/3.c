#include<stdio.h>
void main()
{
	float z=2,m=1,x,t=2,s=0;
	int n,i=1;
	printf("Input n: ");
	scanf("%d",&n);
	while(i<n)
	{
		x=z;
		z=m+z;
		m=x;
		t=t+z/m;
		i=i+1;
	}
		printf("s=%.2f\n",t);

}
