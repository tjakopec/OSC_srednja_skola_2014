//
//  snoitViewController.h
//  iOS_SvastaNestoOITju
//
//  Created by Tomislav Jakopec on 04.05.2014..
//  Copyright (c) 2014. Tomislav Jakopec. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface snoitViewController : UIViewController{
    
    IBOutlet UITextField *prviBroj;
    
    IBOutlet UITextField *drugiBroj;
    IBOutlet UILabel *rezultat;
}


@property (nonatomic, retain) UITextField *prviBroj;

@property (nonatomic, retain) UITextField *drugiBroj;

@property (nonatomic, retain) UILabel *rezultat;

-(IBAction)zbroji;

@end
