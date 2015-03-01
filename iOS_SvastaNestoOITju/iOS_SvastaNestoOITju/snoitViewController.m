//
//  snoitViewController.m
//  iOS_SvastaNestoOITju
//
//  Created by Tomislav Jakopec on 04.05.2014..
//  Copyright (c) 2014. Tomislav Jakopec. All rights reserved.
//

#import "snoitViewController.h"

@interface snoitViewController ()

@end

@implementation snoitViewController


@synthesize prviBroj;
@synthesize drugiBroj;
@synthesize rezultat;


- (IBAction)zbroji;{
    
    
    NSString *putanja =
    [NSString stringWithFormat:@"%@%@%@%@",@"http://web.ffos.hr/oziz/svastanestooit/zbroji.php?tko=ios&pbroj=",prviBroj.text,@"&dbroj=",drugiBroj.text];

    NSURL *_url = [NSURL URLWithString:putanja];
    NSMutableURLRequest *_request = [NSMutableURLRequest requestWithURL:_url];
    NSDictionary *_headers = [NSDictionary dictionaryWithObjectsAndKeys:@"application/json", @"accept", nil];
    [_request setAllHTTPHeaderFields:_headers];
    [NSURLConnection sendAsynchronousRequest:_request
                                       queue:[NSOperationQueue mainQueue]
                           completionHandler:^(NSURLResponse* response, NSData* data, NSError* error) {
                               
                               NSError *_errorJson = nil;
                               NSDictionary *_podaci = [NSJSONSerialization JSONObjectWithData:data options:NSJSONReadingMutableContainers error:&_errorJson];
                               
                               if (_errorJson != nil) {
                                   NSLog(@"Error %@", [_errorJson localizedDescription]);
                               } else {
                                   dispatch_async(dispatch_get_main_queue(), ^{
                                       rezultat.text=[NSString stringWithFormat:@"%@",[_podaci objectForKey:@"rezultat"]];
                                       
                                   });                                   
                               }
                               
                           }];
}




- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
    UITapGestureRecognizer *tap = [[UITapGestureRecognizer alloc]
                                   initWithTarget:self
                                   action:@selector(dismissKeyboard)];
    
    [self.view addGestureRecognizer:tap];
}

-(void)dismissKeyboard {
    [prviBroj resignFirstResponder];
    [drugiBroj resignFirstResponder];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
