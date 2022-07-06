#include"stdio.h"

int main()

{

char M[100];

char C[100];

int K=3,i;

printf("Ã÷ÎÄ£º\n");

gets(M);

for(i=0;M[i]!='\0';i++)

C[i]=(M[i]-'a'+K)%26+'a';

C[i]='\0';

printf("ÃÜÎÄ£º\n%s\n",C);


return 0;

}
