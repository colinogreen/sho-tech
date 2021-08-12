//export class Greeting{
class Greeting{
    
    constructor()
    {
        console.log("Greeting class: Hello world!");
    }
    
    sayGoodbye()
    {
        console.log("Greeting.sayGoodbye() class: Goodbye world!");
    }
}

//export class OtherGreeting{
class OtherGreeting{
    
    constructor()
    {
        console.log("OtherGreeting class: Hello world!");
    }
    
    sayGoodbye()
    {
        console.log("OtherGreeting.sayGoodbye() class: Goodbye world!");
    }
}
export { Greeting,OtherGreeting }
//const Greeting = new Greeting();


