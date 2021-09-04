/*
    编写一个类，统计目前存在多少个该类的对象
*/
#include<iostream>
using namespace std;
class TheClass
{
    static int  num;
    public:
       
       TheClass();
       ~ TheClass();
};
TheClass::TheClass()
{
    num++;
    cout <<"object:    " << num << endl;

}
 TheClass::~ TheClass()
{
    num--;
    cout << "object:    " << num  << endl;
}

int TheClass::num = 0;

int main()
{
    TheClass a1, a2, a3;

    return 0;
}