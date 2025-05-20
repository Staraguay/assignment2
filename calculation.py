#!".venv\Scripts\python.exe"
#print("Content-Type: text/html\n")
import json
import sys
def calculation(a:int,b:int,c:int)-> str:
    c3 = int(c)**3
    step1 = "Step 1: c={}, c^3={}\n".format(c,(c3))
    sqrtC3 = c3**0.5
    step2 = "Step 2: √(c³) = {}\n".format(sqrtC3)
    div = sqrtC3/int(a)
    step3 = "Step 3: {}/{} = {}\n".format(sqrtC3,int(a), div)
    st4 = div*10
    step4 = "Step 4: {} * 10 = {}\n".format(div,st4)
    result = st4 + int(b)
    step5 = "Step 5: {} + {} = {}\n".format(st4,b,result)

    steps = step1+step2+step3+step4+step5
    return json.dumps({
        "steps": steps,
        "result": result
    })


if __name__ == "__main__":
    a, b, c = map(int, sys.argv[1:4])
    print(calculation(a,b,c))