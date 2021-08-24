* 程序填空

```
#include <cstdlib>
#include <iostream>
using namespace std;
int strlen(const char * s) 
{	int i = 0;
	for(; s[i]; ++i);
	return i;
}
void strcpy(char * d,const char * s)
{
	int i = 0;
	for( i = 0; s[i]; ++i)
		d[i] = s[i];
	d[i] = 0;
		
}
int strcmp(const char * s1,const char * s2)
{
	for(int i = 0; s1[i] && s2[i] ; ++i) {
		if( s1[i] < s2[i] )
			return -1;
		else if( s1[i] > s2[i])
			return 1;
	}
	return 0;
}
void strcat(char * d,const char * s)
{
	int len = strlen(d);
	strcpy(d+len,s);
}
class MyString
{
// 在此处补充你的代码
};


int CompareString( const void * e1, const void * e2)
{
	MyString * s1 = (MyString * ) e1;
	MyString * s2 = (MyString * ) e2;
	if( * s1 < *s2 )
	return -1;
	else if( *s1 == *s2)
	return 0;
	else if( *s1 > *s2 )
	return 1;
}
int main()
{
	MyString s1("abcd-"),s2,s3("efgh-"),s4(s1);
	MyString SArray[4] = {"big","me","about","take"};
	cout << "1. " << s1 << s2 << s3<< s4<< endl;
	s4 = s3;
	s3 = s1 + s3;
	cout << "2. " << s1 << endl;
	cout << "3. " << s2 << endl;
	cout << "4. " << s3 << endl;
	cout << "5. " << s4 << endl;
	cout << "6. " << s1[2] << endl;
	s2 = s1;
	s1 = "ijkl-";
	s1[2] = 'A' ;
	cout << "7. " << s2 << endl;
	cout << "8. " << s1 << endl;
	s1 += "mnop";
	cout << "9. " << s1 << endl;
	s4 = "qrst-" + s2;
	cout << "10. " << s4 << endl;
	s1 = s2 + s4 + " uvw " + "xyz";
	cout << "11. " << s1 << endl;
	qsort(SArray,4,sizeof(MyString),CompareString);
	for( int i = 0;i < 4;i ++ )
	cout << SArray[i] << endl;
	//s1的从下标0开始长度为4的子串
	cout << s1(0,4) << endl;
	//s1的从下标5开始长度为10的子串
	cout << s1(5,10) << endl;
	return 0;
}
```



```
输入
无

输出
1. abcd-efgh-abcd-
2. abcd-
3.
4. abcd-efgh-
5. efgh-
6. c
7. abcd-
8. ijAl-
9. ijAl-mnop
10. qrst-abcd-
11. abcd-qrst-abcd- uvw xyz
about
big
me
take
abcd
qrst-abcd-
```



# 解答（已测试通过来）

```c++
#include <cstdlib>
#include <iostream>
using namespace std;

int strlen(const char * s)
{	int i = 0;
    for(; s[i]; ++i);
    return i;
}

void strcpy(char * d,const char * s)
{
    int i = 0;
    for( i = 0; s[i]; ++i)
        d[i] = s[i];
    d[i] = 0;

}

int strcmp(const char * s1,const char * s2)
{
    for(int i = 0; s1[i] && s2[i] ; ++i) {
        if( s1[i] < s2[i] )
            return -1;
        else if( s1[i] > s2[i])
            return 1;
    }
    return 0;
}

void strcat(char * d,const char * s)
{
    int len = strlen(d);
    strcpy(d+len,s);
}

class MyString
{
private:
    char *ps = nullptr;
    int size;
public:
    MyString() {
       ps = new char [1];
       size = 1;
       ps[0] = '\0';
    }

    MyString(const char *s) {
        if (s) {
            size = strlen(s);
            ps = new char[size + 1];

            for (int i=0; i<size; ++i) {
                ps[i] = s[i];
            }
            ps[size] = '\0';
        } else {
            ps = nullptr;
            size = 0;
        }
    }

    // 拷贝构造函数, 参数列表要加const
    MyString(const MyString &s) {
        if (s.ps) {
            size = s.size;
            ps = new char[size + 1];
            strcpy(ps, s.ps);
            ps[size] = '\0';
        } else {
            ps = nullptr;
            size = 0;
        }
    }

    ~MyString() {
        delete [] ps;
    }

    bool operator == (const MyString& s) {
        return strcmp(ps, s.ps) == 0;
    }

    bool operator > (const MyString& s) {
        return strcmp(ps, s.ps) == 1;
    }

    bool operator < (const MyString& s) {
        return strcmp(ps, s.ps) == -1;
    }

    MyString& operator += (const char *s) {
        char *tmp = new char [size+strlen(s)+1];
        strcpy(tmp, ps);

        if (ps) {
            delete[] ps;
        }

        ps = tmp;
        size = size + strlen(s) + 1;
        strcat(ps, s);
        ps[size] = '\0';

        return *this;
    }

    MyString& operator = (const MyString& s) {
        if (ps==s.ps) {
            return *this;
        }

        if (ps) {
            delete[] ps;
        }

        if (s.ps) { // 不为空指针才执行复制工作
            size = s.size;
            ps = new char [size+1];
            strcpy(ps, s.ps);
            ps[size] = '\0';
        } else {
            ps = nullptr;
            size = 0;
        }

        return *this;
    }

    MyString& operator = (const char* s) {
        delete [] ps;
        size = strlen(s);
        ps = new char [size+1];
        strcpy(ps, s);
        ps[size] = '\0';

        return *this;
    }

    MyString operator + (const MyString& s) {
        MyString tmp;

        tmp.size = size+s.size;
        tmp.ps = new char[tmp.size+1];
        strcpy(tmp.ps, ps);
        strcat(tmp.ps+size, s.ps);
        tmp.ps[tmp.size] = '\0';

        return tmp;
    }

    MyString operator + (const char* s) {
        MyString tmp;
        tmp.size = size + strlen(s);
        tmp.ps = new char [tmp.size+1];
        strcpy(tmp.ps, ps);
        strcat(tmp.ps+size, s);
        tmp.ps[tmp.size] = '\0';

        return tmp;
    }

    friend MyString operator + (const char* s1, const MyString& s2) {
        MyString tmp;

        tmp.size = strlen(s1) + s2.size;
        tmp.ps = new char [tmp.size+1];
        strcpy(tmp.ps, s1);
        strcat(tmp.ps+strlen(s1), s2.ps);
        tmp.ps[tmp.size] = '\0';

        return tmp;
    }

    friend ostream& operator << (ostream &ou, const MyString& s) {
        if (s.ps) { // 不为空指针才输出
            ou << s.ps;
        }
        return ou;
    }

    MyString operator()(const int &pos, const int &len) {
        MyString tmp;

        tmp.size = len;
        tmp.ps = new char [tmp.size+1];

        for (int i=pos, j=0; j<len; ++i, ++j){
            tmp.ps[j] = ps[i];
        }

        tmp.ps[tmp.size] = '\0';

        return tmp;
    }

    char& operator[](const int& pos) {
        int i=0;
        for (; i<pos; ++i) {
            ;
        }
        return ps[i];
    }
};


int CompareString( const void * e1, const void * e2)
{
    MyString * s1 = (MyString * ) e1;
    MyString * s2 = (MyString * ) e2;
    if( * s1 < *s2 )
        return -1;
    else if( *s1 == *s2)
        return 0;
    else if( *s1 > *s2 )
        return 1;
}

int main()
{
    MyString s1("abcd-"),s2,s3("efgh-"),s4(s1);

    MyString SArray[4] = { "big","me","about","take" };
    cout << "1. " << s1 << s2 << s3<< s4<< endl;
    s4 = s3;
    s3 = s1 + s3;
    cout << "2. " << s1 << endl;
    cout << "3. " << s2 << endl;
    cout << "4. " << s3 << endl;
    cout << "5. " << s4 << endl;
    cout << "6. " << s1[2] << endl;
    s2 = s1;
    s1 = "ijkl-";
    s1[2] = 'A' ;
    cout << "7. " << s2 << endl;
    cout << "8. " << s1 << endl;
    s1 += "mnop";
    cout << "9. " << s1 << endl;
    s4 = "qrst-" + s2;
    cout << "10. " << s4 << endl;
    s1 = s2 + s4 + " uvw " + "xyz";
    cout << "11. " << s1 << endl;
    qsort(SArray,4,sizeof(MyString),CompareString);
    for( int i = 0;i < 4;i ++ )
        cout << SArray[i] << endl;
    //s1的从下标0开始长度为4的子串
    cout << s1(0,4) << endl;
    //s1的从下标5开始长度为10的子串
    cout << s1(5,10) << endl;
    return 0;
}
```

