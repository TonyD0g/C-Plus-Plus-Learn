/*
    利用静态的概念，编写一个小狗类，统计并输出每个小狗的重量，
    小狗的总数量及总重量。
*/

#include<iostream>
#include<cstring>
using namespace std;
class Dog
{
    private:
        static int total;
        static float totalWeight;
        char Name[5];

    public:
        Dog(char *name,float weight);//名字，重量
        void PrintDog();
};
Dog::Dog(char *name,float weight)
{
    strcpy(Name, name);
    cout << "I am A dog,and my name is:   " << Name <<"     ,My weight is: "<<weight<< endl;
    total = total + 1;
    totalWeight = totalWeight + weight;
}
void Dog::PrintDog()
{
    cout << "All the Dog total is:    " << total << endl;
    cout << "The totalWeight is:   " << totalWeight << endl;

}
int Dog::total = 0;
float Dog::totalWeight = 0;
int main()
{
    Dog dog1((char*)"SW",30), dog2((char*)"FK",20);
    dog1.PrintDog();

    return 0;
}
//C++ forbids converting a string constant to 'char*'