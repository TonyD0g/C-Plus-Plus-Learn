#include<stdio.h>
#include<math.h>
int main()
{
	
	int i,m,n;
	printf("Input m: ");
	scanf("%d",&m);
	printf("Input n: ");
	scanf("%d",&n);
	for(i=m;i<=n;i++)
		if(is(i))
			printf("%d\n",i);
		printf("\n");
		return 0;
	
}

int is(int n)
{
	int i,m,ct,b[20];
	if(n<100)
		return 0;
	m=n;
	ct=0;
	while(m!=0)
	{
		b[ct++]=m%10;
		m=m/10;
	
	}
	for(i=0;i<ct;i++)
		m+=(int)pow(b[i],ct);
	if(m==n)
		return 1;
		return 0;
}
